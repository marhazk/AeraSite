/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.IO.Protocol.ProtocolException;
/*    */ import com.goldhuman.IO.Protocol.Rpc;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class UserRoleCount extends Rpc
/*    */ {
/*    */   public int retcode;
/*    */   public int count;
/*    */   public int rolelist;
/*    */ 
/*    */   public void Server(Rpc.Data argument, Rpc.Data result)
/*    */     throws ProtocolException
/*    */   {
/* 16 */     UserRoleCountArg arg = (UserRoleCountArg)argument;
/* 17 */     UserRoleCountRes res = (UserRoleCountRes)result;
/*    */   }
/*    */ 
/*    */   public void Client(Rpc.Data argument, Rpc.Data result) throws ProtocolException
/*    */   {
/* 22 */     UserRoleCountArg arg = (UserRoleCountArg)argument;
/* 23 */     UserRoleCountRes res = (UserRoleCountRes)result;
/*    */ 
/* 25 */     synchronized (this)
/*    */     {
/* 27 */       this.retcode = res.retcode;
/* 28 */       this.count = res.count;
/* 29 */       this.rolelist = res.rolelist;
/* 30 */       notify();
/*    */     }
/*    */   }
/*    */ 
/*    */   public void OnTimeout()
/*    */   {
/* 36 */     synchronized (this)
/*    */     {
/* 38 */       this.retcode = 4;
/* 39 */       notify();
/*    */     }
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.UserRoleCount
 * JD-Core Version:    0.6.2
 */