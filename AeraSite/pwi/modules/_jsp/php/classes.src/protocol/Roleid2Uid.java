/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.IO.Protocol.ProtocolException;
/*    */ import com.goldhuman.IO.Protocol.Rpc;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class Roleid2Uid extends Rpc
/*    */ {
/*    */   public int retcode;
/*    */   public int userid;
/*    */ 
/*    */   public void Server(Rpc.Data argument, Rpc.Data result)
/*    */     throws ProtocolException
/*    */   {
/* 15 */     Roleid2UidArg arg = (Roleid2UidArg)argument;
/* 16 */     Roleid2UidRes res = (Roleid2UidRes)result;
/*    */   }
/*    */ 
/*    */   public void Client(Rpc.Data argument, Rpc.Data result) throws ProtocolException
/*    */   {
/* 21 */     Roleid2UidArg arg = (Roleid2UidArg)argument;
/* 22 */     Roleid2UidRes res = (Roleid2UidRes)result;
/*    */ 
/* 24 */     synchronized (this)
/*    */     {
/* 26 */       this.retcode = res.retcode;
/* 27 */       this.userid = res.userid;
/* 28 */       notify();
/*    */     }
/*    */   }
/*    */ 
/*    */   public void OnTimeout()
/*    */   {
/* 34 */     synchronized (this)
/*    */     {
/* 36 */       this.retcode = 4;
/* 37 */       notify();
/*    */     }
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.Roleid2Uid
 * JD-Core Version:    0.6.2
 */