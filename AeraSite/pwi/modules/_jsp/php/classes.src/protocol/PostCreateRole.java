/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.IO.Protocol.ProtocolException;
/*    */ import com.goldhuman.IO.Protocol.Rpc;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class PostCreateRole extends Rpc
/*    */ {
/*    */   public int retcode;
/*    */ 
/*    */   public void Server(Rpc.Data argument, Rpc.Data result)
/*    */     throws ProtocolException
/*    */   {
/* 14 */     PostCreateRoleArg arg = (PostCreateRoleArg)argument;
/* 15 */     PostCreateRoleRes res = (PostCreateRoleRes)result;
/*    */   }
/*    */ 
/*    */   public void Client(Rpc.Data argument, Rpc.Data result) throws ProtocolException
/*    */   {
/* 20 */     PostCreateRoleArg arg = (PostCreateRoleArg)argument;
/* 21 */     PostCreateRoleRes res = (PostCreateRoleRes)result;
/*    */ 
/* 23 */     synchronized (this)
/*    */     {
/* 25 */       this.retcode = res.retcode;
/* 26 */       notify();
/*    */     }
/*    */   }
/*    */ 
/*    */   public void OnTimeout()
/*    */   {
/* 32 */     synchronized (this)
/*    */     {
/* 34 */       this.retcode = 4;
/* 35 */       notify();
/*    */     }
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.PostCreateRole
 * JD-Core Version:    0.6.2
 */