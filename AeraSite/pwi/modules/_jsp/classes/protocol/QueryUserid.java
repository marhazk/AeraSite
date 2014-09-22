/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.IO.Protocol.ProtocolException;
/*    */ import com.goldhuman.IO.Protocol.Rpc;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class QueryUserid extends Rpc
/*    */ {
/*    */   public int retcode;
/*    */   public QueryUseridRes queryUseridRes;
/*    */ 
/*    */   public void Server(Rpc.Data argument, Rpc.Data result)
/*    */     throws ProtocolException
/*    */   {
/* 14 */     QueryUseridArg arg = (QueryUseridArg)argument;
/* 15 */     QueryUseridRes res = (QueryUseridRes)result;
/*    */   }
/*    */ 
/*    */   public void Client(Rpc.Data argument, Rpc.Data result) throws ProtocolException
/*    */   {
/* 20 */     QueryUseridArg arg = (QueryUseridArg)argument;
/* 21 */     QueryUseridRes res = (QueryUseridRes)result;
/* 22 */     synchronized (this)
/*    */     {
/* 24 */       this.retcode = res.result;
/* 25 */       if (0 == this.retcode)
/* 26 */         this.queryUseridRes = res;
/*    */       else
/* 28 */         this.queryUseridRes = null;
/* 29 */       notify();
/*    */     }
/*    */   }
/*    */ 
/*    */   public void OnTimeout()
/*    */   {
/* 35 */     synchronized (this)
/*    */     {
/* 37 */       this.retcode = 4;
/* 38 */       this.queryUseridRes = null;
/* 39 */       notify();
/*    */     }
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.QueryUserid
 * JD-Core Version:    0.6.2
 */